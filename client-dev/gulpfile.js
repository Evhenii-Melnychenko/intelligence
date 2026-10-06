import gulp from "gulp";
import { path } from "./gulp/config/path.js";
import { plugins } from "./gulp/config/plugins.js";

// Get value to global variable
global.app = {
  isBuild: process.argv.includes('--build'),
  isDev: !process.argv.includes('--build'),
  path: path,
  gulp: gulp,
  plugins: plugins
};

// Import tasks
import { reset } from "./gulp/tasks/reset.js";
import { html } from "./gulp/tasks/html.js";
import { server } from "./gulp/tasks/server.js";
import { scss } from "./gulp/tasks/scss.js";
import { js, moveLibFolder } from "./gulp/tasks/js.js";
import { images } from "./gulp/tasks/images.js";
import { fonts } from "./gulp/tasks/fonts.js";

function watcher() {
  gulp.watch(path.watch.html, html);
  gulp.watch(path.watch.scss, scss);
  gulp.watch(path.watch.js, js);
  gulp.watch(path.watch.images, images);
}

// Main tasks
const mainTasks = gulp.series(fonts, moveLibFolder, gulp.parallel(html, scss, js, images));

const dev = gulp.series(reset, mainTasks, gulp.parallel(watcher, server));
const build = gulp.series(reset, mainTasks);

export { dev };
export { build };

gulp.task('default', dev);

