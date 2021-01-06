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

    <!-- <el-input v-model="search" placeholder="输入搜索内容" style="width:73%"></el-input>
    <el-select v-model="methodSelector" placeholder="搜索标题">
      <el-option label="搜索标题" value="0"></el-option>
      <el-option label="搜索描述" value="1"></el-option>
    </el-select>
    <el-button type="primary" icon="el-icon-search" size="small" @click="searchByTitleOrContent">搜索</el-button> -->
   </el-col>
  </div>
</template>

<script>
import '@/assets/reset.css'

export default {
  name: 'Search_doctor',
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