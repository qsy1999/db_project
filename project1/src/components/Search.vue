<template>

 <div style="width:90%;margin:2% 5%">
   <q-search-doctor></q-search-doctor>
 </div>

</template>

<script>
import '@/assets/reset.css'
import Search_doctor from '@/components/Search_doctor'

export default {
  name: 'Search',
  components: {
    'q-search-doctor':Search_doctor,
  },
  data () {
    return {
      
    }
  },
  methods:{

    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>