<template>
  <div>
   <el-col :span="4" >
    <el-menu default-active="2" style="border-radius:15px 0 0 15px;background:#ffffff;border-right:none">
      <el-menu-item index="1" style="border-radius:15px 0 0 0">
        <i class="el-icon-first-aid-kit"></i>
        <span slot="title">查询医护人员</span>
      </el-menu-item>
      <el-menu-item index="2" style="border-radius:0 0 0 15px">
        <i class="el-icon-user"></i>
        <span slot="title">查询病人</span>
      </el-menu-item>
    </el-menu>
   </el-col>

   <el-col :span="20" style="border-radius:0 15px 15px 15px;background:#ffffff;min-height:500px">

    <el-radio-group v-model="dischargable">
      <el-radio-button label="0">不启用此筛选项</el-radio-button>
      <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
      <el-radio-button label="1">已可出院</el-radio-button>
      <el-radio-button label="2">不可出院</el-radio-button>
    </el-radio-group>

    <el-radio-group v-model="dischargable">
      <el-radio-button label="0">不启用此筛选项</el-radio-button>
      <el-radio-button label="" disabled><i class="el-icon-caret-right"></i></el-radio-button>
      <el-radio-button label="1">已可出院</el-radio-button>
      <el-radio-button label="2">不可出院</el-radio-button>
    </el-radio-group>

   </el-col>

  </div>
</template>

<script>
import '@/assets/reset.css'

export default {
  name: 'Search_doctor',
  data () {
    return {
      dischargable:'0',
    }
  },
  methods:{
    
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>