<template>
 <div>
  <q-nav :name='name' :auth='type' v-on:changeContent="changeContent"></q-nav>

  <div style="min-height:500px">
    <q-search v-if="content=='0'" :id='id' :auth='type' :area='area'></q-search>
    <q-add v-if="content=='1'||content=='2'" :id='id' :area='area' :type='type'></q-add>
    <q-info-change :id='id' v-if="content=='3'"></q-info-change>
    <div v-if="content==4">
      <span class="title" v-if="type=='doctor'">以下病人已经满足出院条件</span>
      <span class="title" v-if="type=='chief nurse'">以下病人转来该治疗区域</span>
      <q-table :type='tabType' :tableData='tableData' :id='id' :auth='auth'></q-table>
    </div>
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
import Add from '@/components/Add'
import Table from '@/components/Table'



export default {
  name: 'Home',
  components: {
    'q-footer':Footer,
    'q-nav':Nav,
    'q-search':Search,
    'q-info-change':InfoChange,
    'q-add':Add,
    'q-table':Table,
  },
  
  data () {
    return {
      content:'-1',
      id: '0',
      name: 'this.this.$route.params.name',
      type:'doctor',
      area:'0',
      auth:2,
      tabType:0,
      tableData:[],
    }
  },  
  methods:{
    changeContent(e)
    {
      this.content=e;
      console.log(this.type);
      console.log(this.area);
      if (this.content==4) {
          this.$axios.post('/api/getMessage.php',{
	          target:this.id,
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             this.tableData = response.data;

             }).catch((error) => {
             console.log(error);
          });
      }
    }
  },

  mounted(){
    this.id=this.$route.params.id;
    this.name=this.$route.params.name;
    this.type=this.$route.params.type;
    this.area=this.$route.params.area;
    console.log(this.type);
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .title{
    margin:20px 0 0 350px;
    font-size:300%;
  }
</style>
