<template>

 <div style="width:90%;margin:2% 5%">
   <q-search-doctor v-if="auth=='doctor'" :id='id' :area_type='area'></q-search-doctor>
   <q-search-chief-nurse v-if="auth=='chief nurse'" :id='id' :area_type='area'></q-search-chief-nurse>
   <q-search-emergency-nurse v-if="auth=='emergency nurse'" :id='id' :area_type='area'></q-search-emergency-nurse>
   <q-search-hospital-nurse v-if="auth=='hospital nurse'" :id='id' :area_type='area'></q-search-hospital-nurse>
 </div>

</template>

<script>
import '@/assets/reset.css'
import Search_doctor from '@/components/Search_doctor'
import Search_chief_nurse from '@/components/Search_chief_nurse'
import Search_emergency_nurse from '@/components/Search_emergency_nurse'
import Search_hospital_nurse from '@/components/Search_hospital_nurse'


export default {
  name: 'Search',
  components: {
    'q-search-doctor':Search_doctor,
    'q-search-chief-nurse':Search_chief_nurse,
    'q-search-emergency-nurse':Search_emergency_nurse,
    'q-search-hospital-nurse':Search_hospital_nurse,
  },
  data () {
    return {
      user_type:'',
    }
  },
  props:{
      auth:String,
      id:String,
      area:String,
  },
  methods:{

    },
  mounted(){
    this.user_type=this.auth;
    console.log(this.auth);
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>