import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import rename from 'gulp-rename';
import cleanCss from 'gulp-clean-css';
import webpcss from 'gulp-webpcss';
import autoprefixer from 'gulp-autoprefixer';
import mmq from 'gulp-merge-media-queries';

const sass = gulpSass(dartSass);

export const scss = () => {
  return app.gulp.src([
    `${app.path.src.scss}main.scss`,
    `${app.path.src.scss}home.scss`,
    `${app.path.src.scss}ai-intro.scss`,
    `${app.path.src.scss}news.scss`,
    `${app.path.src.scss}podcasts.scss`,
    `${app.path.src.scss}resources.scss`,
    `${app.path.src.scss}contact.scss`,
  ], { sourcemaps: app.isDev })
    .pipe(app.plugins.plumber(
      app.plugins.notify.onError({
        title: "SCSS",
        message: "Error: <%= error.message %>"
      })
    ))
    .pipe(app.plugins.replace(/@img\//g, '../images/'))
    .pipe(sass({
      outputStyle: 'expanded'
    }))
    .pipe(
      app.plugins.if(
        app.isBuild,
        mmq()
      )
    )
    .pipe(
      app.plugins.if(
        app.isBuild,
        webpcss({
          webpClass: ".webp",
          noWebpClass: ".no-webp"
        })
      )
    )
    .pipe(
      app.plugins.if(
        app.isBuild,
        autoprefixer({
          grid: true,
          overrideBrowserslist: ["last 10 version", "> 2%", "not dead", "IE 11"],
          cascade: true
        })
      )
    )
    .pipe(app.gulp.dest(app.path.build.css, { sourcemaps: app.isDev }))
    .pipe(
      app.plugins.if(
        app.isBuild,
        cleanCss()
      )
    )
    .pipe(
      app.plugins.if(
        app.isBuild,
        rename({
          suffix: ".min"
        })
      )
    )
    .pipe(
      app.plugins.if(
        app.isBuild,
        app.gulp.dest(app.path.build.css)
      )
    )
    .pipe(app.plugins.browsersync.stream());
};
