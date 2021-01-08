<template>
  <div style="border-radius:15px;background:#ffffff;min-height:500px">

          <el-radio-group v-model="special" style="margin:50px 0 0 100px">
            <el-radio-button label="0" @click.native="specialSearch">不启用此筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="4" @click.native="specialSearch">已可出院</el-radio-button>
            <el-radio-button label="5" @click.native="specialSearch">不可出院</el-radio-button>

            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="8" @click.native="specialSearch">康复出院</el-radio-button>
            <el-radio-button label="9" @click.native="specialSearch">正在治疗</el-radio-button>
            <el-radio-button label="10" @click.native="specialSearch">&nbsp&nbsp&nbsp&nbsp病亡&nbsp&nbsp&nbsp&nbsp</el-radio-button>
          </el-radio-group>


    <q-table :tableData='tableData' :type='target' :auth='3' :id='id' v-if="target!='-1'"></q-table>

  </div>
</template>

<script>
import '@/assets/reset.css'
import Table from '@/components/Table'

export default {
  name: 'Search_chief_nurse',
  components: {
    'q-table':Table,
  },
  data () {
    return {
      area:'0',
      target:0,
      special:'0',
      selector:'0',
      selector_value:'',
      tableData:[
        {
          id:'--',
          name:'--',
          area:'--'
        },
      ]
    }
  },
  props:{
      id:String,
      area_type:String,
  },
  methods:{
      changeSearchTarget(target)
      {
        this.target=target;
      },

      superSearch (target,area,special,selector,selector_value) 
      {
          this.$axios.post('/api/superSearch.php',{
             target:target,
             area:area,
             special:special,
             selector:selector,
             selector_value:selector_value
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             this.tableData=response.data;
             }).catch((error) => {
             console.log(error);
          });
      },

      searchWithSelectorValue()
      {
        this.superSearch(this.target,this.area,0,this.selector,this.selector_value);
      },
      searchWithoutSelectorValue()
      {
        this.superSearch(this.target,this.area,this.special,0,0);
      },

      specialSearch()
      {
        this.superSearch(this.target,this.area,this.special,3,this.id);
      }

    },
    mounted(){
      if(this.area_type=="mild")this.area=2;
      if(this.area_type=="intense")this.area=3;
      if(this.area_type=="critical")this.area=4;
      this.superSearch(0,this.area,0,3,this.id);
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .select-item{
    margin-top:10px
  }
  .selector{
    width:150px
  }
  .detail_input{
    margin-left:200px;
    width:500px
  }


</style>