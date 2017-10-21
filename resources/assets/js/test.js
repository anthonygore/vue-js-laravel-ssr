var vm = new Vue({
  template: `<div>{{ msg }}</div>`,
  data: {
    msg: 'hello'
  }
})

// exposed by vue-server-renderer/basic.js
renderVueComponentToString(vm, (err, res) => {
  print(res)
})
