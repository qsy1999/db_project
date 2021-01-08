<template>
  <div>
    <el-table
      :data="tableData"
      style="width: 80%; margin:10px 10%">
      <el-table-column
        prop="id"
        label="ID"
        width="180">
      </el-table-column>
      <el-table-column
        v-if="type!=2"
        prop="name"
        label="姓名"
        width="180">
      </el-table-column>
      <el-table-column
        v-if="type==2"
        prop="name"
        label="病人姓名"
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
        <el-button type="text" size="small" @click="dialogVisible = true;displayPatient(scope.row)">查看</el-button>
        <el-button type="text" size="small" >开除</el-button>
       </template>
      </el-table-column>
    </el-table>

    <el-dialog
      title="具体信息"
      :visible.sync="dialogVisible"
      width="85%">

      <span style="margin-left:5%">id:{{detail.id}}&nbsp&nbsp&nbsp&nbspname:{{detail.name}}</span>
      <br>
      <div style="margin:20px 0 0 50px">
      <el-button type="primary" size="small" >添加新核酸检测记录</el-button>
      <el-button type="primary" size="small" >确认病人死亡</el-button>
      <el-button type="primary" size="small" >允许病人出院</el-button>
      </div>
      <br>
      <el-table
      :data="detail.history"
      style="width: 90%; margin:10px 5%">
      <el-table-column
        prop=""
        label="记录时间">
      </el-table-column>
      <el-table-column
        prop=""
        label="记录者">
      </el-table-column>
      <el-table-column
        prop=""
        label="体温">
      </el-table-column>
      <el-table-column
        prop=""
        label="症状">
      </el-table-column>
      <el-table-column
        prop=""
        label="状态">
      </el-table-column>      
      <el-table-column
        prop=""
        label="核酸检测结果">
      </el-table-column>
      <el-table-column
        prop=""
        label="病情评级">
      </el-table-column>
      <el-table-column
        prop=""
        label="核酸检测者">
      </el-table-column>
      <el-table-column
        prop=""
        label="核酸检测时间">
      </el-table-column>
    </el-table>

    </el-dialog>
  </div>

</template>

<script>
import '@/assets/reset.css'
export default {
  name: 'Table',
  data () {
    return {
      detail:{
        id:'',
        name:'',
        history:[],
      },
      dialogVisible:false,
    }
  },
  props:{
      auth:Number,
      id:String,
      type:Number,
      tableData:Array,
  },
  methods:{
      displayPatient(row)
      {
        console.log(row);
      },
      dismiss(row)
      {
        this.$axios.post('/api/changeInfo.php',{
	          id:row.id,
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             if (response.data.success=="0") {
               alert('失败');
             }else if (response.data.success=="1") {
               alert('成功');
             }

             }).catch((error) => {
             console.log(error);
          });
      },
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>