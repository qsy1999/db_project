<template>

 <el-menu mode="horizontal" style="padding:0 50px" background-color="#545c64" text-color="#fff" active-text-color="#ffd04b">
  <el-menu-item index="1" @click.native="changeContent(0);">查询</el-menu-item>
  <el-menu-item index="2" v-if="auth=='chief nurse'" @click.native="changeContent(1);">添加病房护士</el-menu-item>
  <el-menu-item index="3" v-if="auth=='emergency nurse'" @click.native="changeContent(2);">添加病人</el-menu-item>


  <el-menu-item index="4" style="float:right">
   <el-dropdown>
    <span class="el-dropdown-link" style="color:white">
      个人中心 &nbsp; <i class="el-icon-more"></i>
    </span>
    <el-dropdown-menu slot="dropdown">
      <el-dropdown-item @click.native="changeContent(3);"><i class="el-icon-upload2"></i>修改信息</el-dropdown-item>
      <el-dropdown-item @click.native="changeContent(4);" v-if="auth=='chief nurse'||auth=='doctor'"><i class="el-icon-bell"></i>消息</el-dropdown-item>
      <el-dropdown-item ><i class="el-icon-user"></i>登出</el-dropdown-item>
    </el-dropdown-menu>
   </el-dropdown>
  </el-menu-item>
  <span class="el-dropdown-link" style="color:white;float:right;margin:20px 60px 0 0">
      welcome,&nbsp{{name}}
  </span>
 </el-menu>

</template>

<script>
export default {
  name: 'Nav',
  data () {
    return {
      type:'',
    }
  },
  props:{
      name:String,
      auth:String,
  },
  methods:{
    changeContent(e)
    {
      this.$emit("changeContent",e);
    }
  },
  mounted(){
    this.type=this.auth;
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>