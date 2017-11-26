import app from './app'

renderVueComponentToString(app, (err, res) => {
  print(res);
});
