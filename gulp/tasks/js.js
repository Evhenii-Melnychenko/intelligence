import webpack from 'webpack-stream';

export const js = () => {
  return app.gulp.src(app.path.src.js, { sourcemaps: app.isDev })
    .pipe(app.plugins.plumber(
      app.plugins.notify.onError({
        title: "JS",
        message: "Error: <%= error.message %>"
      })
    ))
    .pipe(webpack({
      mode: app.isBuild ? 'production' : 'development',
      devtool: app.isDev ? 'source-map' : false,
      output: {
        filename: '[name].js',
      },
      entry: {
        'main': './app/src/js/main.js',
      },
      module: {
        rules: [
          {
            test: /\.m?js$/,
            resolve: {
              fullySpecified: false
            }
          },
          {
            test: /\.(js)$/,
            exclude: /(node_modules)/,
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env']
            }
          }
        ]
      },
      resolve: {
        extensions: ['.js', '.json']
      }
    }))
    .pipe(app.gulp.dest(app.path.build.js, { sourcemaps: app.isDev }))
    .pipe(app.plugins.browsersync.stream());
};

export const moveLibFolder = () => {
  return app.gulp.src(app.path.src.lib)
    .pipe(app.gulp.dest(app.path.build.lib));
};
