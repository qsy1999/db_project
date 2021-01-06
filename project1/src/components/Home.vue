<template>
 <div>
  <q-nav></q-nav>

  <div style="min-height:500px">
    <q-search></q-search>
  </div>

  <q-footer></q-footer>

 </div>


</template>

<script>
import '@/assets/reset.css'
import Footer from '@/components/Footer'
import Nav from '@/components/Nav'
import Search from '@/components/Search'


export default {
  name: 'Home',
  components: {
    'q-footer':Footer,
    'q-nav':Nav,
    'q-search':Search,
  },
  data () {
    return {
      name: ''
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
