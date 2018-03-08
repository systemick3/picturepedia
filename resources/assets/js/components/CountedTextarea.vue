<template>
  <div>
    <textarea
      v-model='taValue'
      :rows='rows'
      :cols='cols'
      :name='name'
      :placeholder='placeholder'
      @input='$emit("input", taValue)'>
    </textarea>
    <span :class="{overMax: isOverMax}">Remaining: {{ remaining }}</span>
  </div>
</template>
<script>
  export default {
    data(){
      return {
        taValue: this.existing,
      }
    },
    computed:{
      isOverMax(){
        return this.remaining < 0
      },
      remaining(){
        if (!this.taValue) {
          return this.maxCharacters;
        }

        return this.maxCharacters - this.taValue.length
      }
    },
    props:["maxCharacters", "rows", "cols", "name", "placeholder", "existing"]
  }
</script>
