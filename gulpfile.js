import path from 'path'
import fs from 'fs'
import { glob } from 'glob'
import { src, dest, watch, series } from 'gulp'
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'
import terser from 'gulp-terser'
import cleanCSS from 'gulp-clean-css' // ✅ Para minificar CSS
import sharp from 'sharp'

const sass = gulpSass(dartSass)

const paths = {
  scss: 'src/scss/**/*.scss',
  js: 'src/js/**/*.js',
  css: 'src/css/**/*.css'
}

// Compilar SCSS
export function scss(done) {
  src(paths.scss, { sourcemaps: true })
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(dest('./public/build/css', { sourcemaps: '.' }))
  done()
}

// Minificar JS
export function js(done) {
  src(paths.js)
    .pipe(terser())
    .pipe(dest('./public/build/js'))
  done()
}

// Minificar CSS
export function css(done) {
  src(paths.css)
    .pipe(cleanCSS()) // ✅ Usamos cleanCSS en lugar de terser
    .pipe(dest('./public/build/css'))
  done()
}

// Procesar imágenes
export async function imagenes(done) {
  const srcDir = './src/img'
  const buildDir = './public/build/img'
  const images = await glob('./src/img/**/*')

  await Promise.all(
    images.map(async (file) => {
      const relativePath = path.relative(srcDir, path.dirname(file))
      const outputSubDir = path.join(buildDir, relativePath)
      await procesarImagenes(file, outputSubDir)
    })
  )

  done()
}

// Función para procesar cada imagen
async function procesarImagenes(file, outputSubDir) {
  if (!fs.existsSync(outputSubDir)) {
    fs.mkdirSync(outputSubDir, { recursive: true })
  }

  const baseName = path.basename(file, path.extname(file))
  const extName = path.extname(file).toLowerCase()

  const outputFile = path.join(outputSubDir, `${baseName}${extName}`)
  const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`)
  const outputFileAvif = path.join(outputSubDir, `${baseName}.avif`)
  const options = { quality: 80 }

  if (extName === '.svg') {
    fs.copyFileSync(file, outputFile)
  } else {
    await sharp(file).toFile(outputFile)
    await sharp(file).webp(options).toFile(outputFileWebp)
    await sharp(file).avif({ quality: 50 }).toFile(outputFileAvif)
  }
}

// Tarea para desarrollo
export function dev() {
  watch(paths.scss, scss)
  watch(paths.js, js)
  watch(paths.css, css)
  watch('src/img/**/*.{png,jpg,jpeg}', imagenes)
}

// Tarea por defecto
export default series(js, scss, css, imagenes, dev)
