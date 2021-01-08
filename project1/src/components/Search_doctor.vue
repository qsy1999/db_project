<template>
  <div>
   <el-col :span="4" >
    <el-menu style="border-radius:15px 0 0 15px;background:#ffffff;border-right:none">
      <el-menu-item index="1" style="border-radius:15px 0 0 0" @click.native="changeSearchTarget(1);">
        <i class="el-icon-first-aid-kit"></i>
        <span slot="title">查询医护人员</span>
      </el-menu-item>
      <el-menu-item index="2" style="border-radius:0 0 0 15px" @click.native="changeSearchTarget(0);">
        <i class="el-icon-user"></i>
        <span slot="title">查询病人</span>
      </el-menu-item>
    </el-menu>
   </el-col>

   <el-col :span="20" style="border-radius:0 15px 15px 15px;background:#ffffff;min-height:500px">
    <div v-if="target=='0'">
    <el-input v-model="selector_value" placeholder="若不需查询具体名字或ID，点击查询所有" class="detail_input">
      <el-select v-model="selector" slot="prepend" placeholder="请选择" class="selector">
        <el-option label="请选择" value="0"></el-option>
        <el-option label="病人姓名" value="1"></el-option>
        <el-option label="病人ID" value="2"></el-option>
        <el-option label="病房护士ID" value="3"></el-option>
      </el-select>
      <el-button slot="append" icon="el-icon-search" @click.native="searchWithSelectorValue"></el-button>
    </el-input>

    <el-button style="margin:30px 0 0 10px;background:#00000008" @click.native="searchWithoutSelectorValue">查询负责区域所有病人列表</el-button>

    <el-dropdown trigger="click" :hide-on-click="false" >
      <span class="el-dropdown-link">
        设置筛选项<i class="el-icon-arrow-down el-icon--right"></i>
      </span>
      <el-dropdown-menu slot="dropdown">
        <el-dropdown-item class="select-item">
          <el-radio-group v-model="special">
            <el-radio-button label="0">不启用筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="4">已可出院</el-radio-button>
            <el-radio-button label="5">不可出院</el-radio-button>

            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="6">正待转入</el-radio-button>
            <el-radio-button label="7">未待转入</el-radio-button>

            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="8">康复出院</el-radio-button>
            <el-radio-button label="9">正在治疗</el-radio-button>
            <el-radio-button label="10">&nbsp&nbsp&nbsp&nbsp病亡&nbsp&nbsp&nbsp&nbsp</el-radio-button>
          </el-radio-group>
        </el-dropdown-item>
      </el-dropdown-menu>
    </el-dropdown>
    </div>

    <div v-if="target=='1'">
      <el-input v-model="selector_value" placeholder="根据名字或ID查询病房护士" class="detail_input">
       <el-select v-model="selector" slot="prepend" placeholder="请选择" class="selector">
        <el-option label="请选择" value="0"></el-option>
        <el-option label="姓名" value="1"></el-option>
        <el-option label="ID" value="2"></el-option>
       </el-select>
       <el-button slot="append" icon="el-icon-search" @click.native="searchWithSelectorValue"></el-button>
      </el-input>

      <el-button style="margin:30px 0 0 10px;background:#00000008" @click.native="searchWithoutSelectorValue">查询本区所有病房护士</el-button>      
      <el-button style="margin:30px 0 0 10px;background:#00000008" @click.native="searchWithoutSelectorValue">查询本区护士长</el-button>
    </div>
    <q-table :tableData='tableData' :type='target' :auth='0' :id='id' v-if="target!='-1'"></q-table>

   </el-col>

  </div>
</template>

<script>
import '@/assets/reset.css'
import Table from '@/components/Table'

export default {
  name: 'Search_doctor',
  components: {
    'q-table':Table,
  },
  data () {
    return {
      area:'0',
      target:'-1',
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
        this.tableData=[];
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
        console.log(this.area);
        this.superSearch(this.target,this.area,this.special,0,0);
      }

    },
    mounted(){
      if(this.area_type=="mild")this.area=2;
      if(this.area_type=="intense")this.area=3;
      if(this.area_type=="critical")this.area=4;
      
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
    margin-left:50px;
    width:500px
  }

</style>