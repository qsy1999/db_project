<template>
  <div style="border-radius:15px;background:#ffffff;min-height:500px">

          <el-radio-group v-model="dischargable" style="margin:50px 0 0 100px">
            <el-radio-button label="0">不启用此筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="1">已可出院</el-radio-button>
            <el-radio-button label="2">不可出院</el-radio-button>
          </el-radio-group>

          <el-radio-group v-model="patient_status" style="margin:50px 0 0 50px">
            <el-radio-button label="0">不启用此筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="1">康复出院</el-radio-button>
            <el-radio-button label="2">正在治疗</el-radio-button>
            <el-radio-button label="3">&nbsp&nbsp&nbsp&nbsp病亡&nbsp&nbsp&nbsp&nbsp</el-radio-button>
          </el-radio-group>


    <q-table :tableData='tableData' :type='target' v-if="target!='-1'" style="margin-top:20px"></q-table>

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
      level:'0',
      target:'0',
      dischargable:'0',
      pending:'0',
      patient_status:'0',
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
  methods:{

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