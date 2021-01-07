<template>
    <el-table
      :data="tableData"
      style="width: 80%; margin:10px 10%">
      <el-table-column
        prop="id"
        label="ID"
        width="180">
      </el-table-column>
      <el-table-column
        prop="name"
        label="姓名"
        width="180">
      </el-table-column>
      <el-table-column
        prop="area"
        label="治疗区域">
      </el-table-column>
      <el-table-column
      label="操作"
      width="100">
       <template slot-scope="scope">
        <el-button type="text" size="small">查看</el-button>
       </template>
      </el-table-column>
    </el-table>


</template>

<script>
import '@/assets/reset.css'
export default {
  name: 'Table',
  data () {
    return {
      
    }
  },
  props:{
      type:Number,
      tableData:Array,
  },
  methods:{
    
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>