export const server = (done) => {
  app.plugins.browsersync.init({
    proxy: 'futuretech.local',
    notify: false,
    port: 3000,
    open: false
  });
  done();
};
