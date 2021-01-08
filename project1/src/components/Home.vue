<template>
 <div>
  <q-nav :name='name'></q-nav>

  <div style="min-height:500px">
    <q-search v-if="content=='1'"></q-search>
    <q-info-change :id='id' v-if="content=='2'"></q-info-change>
  </div>

  <q-footer></q-footer>

 </div>


</template>

<script>
import '@/assets/reset.css'
import Footer from '@/components/Footer'
import Nav from '@/components/Nav'
import Search from '@/components/Search'
import InfoChange from '@/components/InfoChange'


export default {
  name: 'Home',
  components: {
    'q-footer':Footer,
    'q-nav':Nav,
    'q-search':Search,
    'q-info-change':InfoChange
  },
  data () {
    return {
      content:'1',
      id: 'this.$route.params.id',
      name: 'this.this.$route.params.name',
    }
  },
  mounted(){
    this.id=this.$route.params.id;
    this.name=this.$route.params.name;
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
