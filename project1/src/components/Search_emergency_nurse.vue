<template>
  <div style="border-radius:15px;background:#ffffff;min-height:500px">

    <el-input v-model="selector_value" placeholder="若不需查询具体名字或ID，点击查询所有" class="detail_input">
      <el-select v-model="selector" slot="prepend" placeholder="请选择" class="selector">
        <el-option label="病人姓名" value="1"></el-option>
        <el-option label="病人ID" value="2"></el-option>
        <el-option label="病房护士ID" value="3"></el-option>
      </el-select>
      <el-button slot="append" icon="el-icon-search"></el-button>
    </el-input>

    <el-button style="margin:30px 0 0 10px;background:#00000008">查询所有病人列表</el-button>

    <el-dropdown trigger="click" :hide-on-click="false" >
      <span class="el-dropdown-link">
        设置筛选项<i class="el-icon-arrow-down el-icon--right"></i>
      </span>
      <el-dropdown-menu slot="dropdown">
        <el-dropdown-item class="select-item">
          <el-radio-group v-model="dischargable">
            <el-radio-button label="0">不启用此筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="1">已可出院</el-radio-button>
            <el-radio-button label="2">不可出院</el-radio-button>
          </el-radio-group>
        </el-dropdown-item>

        <el-dropdown-item class="select-item">
          <el-radio-group v-model="pending">
            <el-radio-button label="0">不启用此筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="1">正待转入</el-radio-button>
            <el-radio-button label="2">未待转入</el-radio-button>
          </el-radio-group>
        </el-dropdown-item>

        <el-dropdown-item class="select-item">
          <el-radio-group v-model="patient_status">
            <el-radio-button label="0">不启用此筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="1">康复出院</el-radio-button>
            <el-radio-button label="2">正在治疗</el-radio-button>
            <el-radio-button label="3">&nbsp&nbsp&nbsp&nbsp病亡&nbsp&nbsp&nbsp&nbsp</el-radio-button>
          </el-radio-group>
        </el-dropdown-item>

        <el-dropdown-item class="select-item">
          <el-radio-group v-model="area">
            <el-radio-button label="0">不启用此筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="1">&nbsp&nbsp隔离区&nbsp&nbsp</el-radio-button>
            <el-radio-button label="2">轻症治疗区域</el-radio-button>
            <el-radio-button label="3">重症治疗区域</el-radio-button>
            <el-radio-button label="4">危重症治疗区域</el-radio-button>

          </el-radio-group>
        </el-dropdown-item>

        <el-dropdown-item class="select-item">
          <el-radio-group v-model="level">
            <el-radio-button label="0" >不启用此筛选项</el-radio-button>
            <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
            <el-radio-button label="1">&nbsp&nbsp轻症&nbsp&nbsp</el-radio-button>
            <el-radio-button label="2">&nbsp&nbsp重症&nbsp&nbsp</el-radio-button>
            <el-radio-button label="3">危重症</el-radio-button>
          </el-radio-group>
        </el-dropdown-item>
      </el-dropdown-menu>
    </el-dropdown>


    <q-table :tableData='tableData' :type='target' v-if="target!='-1'"></q-table>



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