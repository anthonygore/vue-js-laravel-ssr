import { createApp } from './app'

renderVueComponentToString(createApp(), (err, res) => {
  print(res);
});
