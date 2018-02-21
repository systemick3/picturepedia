<template>
  <div>
    <input type="text" placeholder="what are you looking for?" v-model="query" v-on:keyup="autoComplete" class="form-control">
    <div class="panel-footer" v-if="results.length">
      <ul class="list-group">
        <li class="list-group-item" v-for="result in results">
          <span v-html="result.link"></span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'search-autocomplete',
    data(){
      return {
        query: '',
        results: []
      }
    },
    methods: {
      autoComplete(){
        this.results = [];
        this.users = [];
        this.hashtags = [];
        if(this.query.length > 2) {
          axios.get('/search/' + this.query).then(response => {
            this.results = response.data;
          });
        }
      }
    }
  }
</script>
