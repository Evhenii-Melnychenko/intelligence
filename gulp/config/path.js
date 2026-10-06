import * as nodePath from 'path';
const rootFolder = nodePath.basename(nodePath.resolve());

const buildFolder = `../wp-content/themes/futuretech/assets`;
const srcFolder = `./app/src`;

export const path = {
  build: {
    html: `${buildFolder}/`,
    css: `${buildFolder}/css/`,
    js: `${buildFolder}/js/`,
    images: `${buildFolder}/images/`,
    fonts: `${buildFolder}/fonts/`,
    lib: `${buildFolder}/js/lib/`
  },
  src: {
    images: `${srcFolder}/images/**/*.{jpg,jpeg,png,gif,webp}`,
    svg: `${srcFolder}/images/**/*.svg`,
    js: `${srcFolder}/js/main.js`,
    scss: `${srcFolder}/css/`,
    html: `${srcFolder}/*.html`,
    fonts: `${srcFolder}/fonts/**/*.*`,
    lib: `${srcFolder}/js/lib/**/*.*`
  },
  watch: {
    html: `${srcFolder}/**/*.html`,
    scss: `${srcFolder}/css/**/*.scss`,
    js: `${srcFolder}/js/**/*.js`,
    images: `${srcFolder}/images/**/*.{jpg,jpeg,png,gif,webp,ico,svg}`,
    fonts: `${srcFolder}/fonts/**/*.*`
  },
  clean: [
    `${buildFolder}/css`,
    `${buildFolder}/js`,
    `${buildFolder}/images`,
    `${buildFolder}/fonts`
  ],
  buildFolder: buildFolder,
  srcFolder: srcFolder,
  rootFolder: rootFolder
};
