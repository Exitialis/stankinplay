<template>
    <textarea ref="area"></textarea>
</template>

<script>
  import simplemde from 'simplemde' // import from npm package

  export default {
    props: ['value', 'fetched'],
    mounted() {
      this.mde = new simplemde({element: this.$refs.area })
      this.mde.value(this.value)
      this.mde.codemirror.on('change', () => {
        this.$emit('input', this.mde.value())
      })
    },
    watch: {
      fetched (newValue) {
        this.mde.value(newValue)
      }
    },
    beforeDestroy() {
      this.mde.toTextArea()
    }
  }
</script>
