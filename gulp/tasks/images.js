import webp from "gulp-webp";
import imagemin from "gulp-imagemin";

export const images = () => {
  const rasterImages = `${app.path.srcFolder}/images/**/*.{jpg,jpeg,png,gif,ico}`;

  return app.gulp.src(app.path.src.images)
    .pipe(app.plugins.plumber(
      app.plugins.notify.onError({
        title: "IMAGES",
        message: "Error: <%= error.message %>"
      })
    ))
    .pipe(app.plugins.newer(app.path.build.images))
    .pipe(
      app.plugins.if(
        app.isBuild,
        webp()
      )
    )
    .pipe(
      app.plugins.if(
        app.isBuild,
        app.gulp.dest(app.path.build.images)
      )
    )
    .pipe(
      app.plugins.if(
        app.isBuild,
        app.gulp.src(rasterImages)
      )
    )
    .pipe(
      app.plugins.if(
        app.isBuild,
        app.plugins.newer(app.path.build.images)
      )
    )
    .pipe(
      app.plugins.if(
        app.isBuild,
        imagemin({
          progressive: true,
          interlaced: true,
          optimizationLevel: 3
        })
      )
    )
    .pipe(app.gulp.dest(app.path.build.images))
    .pipe(app.gulp.src(app.path.src.svg))
    .pipe(app.gulp.dest(app.path.build.images))
    .pipe(app.plugins.browsersync.stream());
};
