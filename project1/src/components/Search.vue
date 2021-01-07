<template>

 <div style="width:90%;margin:2% 5%">
   <q-search-doctor v-if="user_type=='1'"></q-search-doctor>
   <q-search-chief-nurse></q-search-chief-nurse>
 </div>

</template>

<script>
import '@/assets/reset.css'
import Search_doctor from '@/components/Search_doctor'
import Search_chief_nurse from '@/components/Search_chief_nurse'


export default {
  name: 'Search',
  components: {
    'q-search-doctor':Search_doctor,
    'q-search-chief-nurse':Search_chief_nurse,
  },
  data () {
    return {
      user_type:'0',
    }
  },
  methods:{

    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>