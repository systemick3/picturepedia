
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component("counted-textarea", {
  props:["maxCharacters", "rows", "cols", "name", "placeholder", "value"],
  template: `
    <div>
      <textarea v-model='taValue' :rows='rows' :cols='cols' :name='name' :placeholder='placeholder '@input='$emit("input", taValue)'></textarea>
      <span :class="{overMax: isOverMax}">Remaining: {{ remaining }}</span>
    </div>`,
  data(){
    return {
      taValue: this.value
    }
  },
  computed:{
    isOverMax(){
      return this.remaining < 0
    },
    remaining(){
      if (!this.taValue)
        return this.maxCharacters;

      return this.maxCharacters - this.taValue.length
    }
  }
});

const app = new Vue({
    el: '#app',
    data:{
      captionText: null,
      commentText: null
    }
});
