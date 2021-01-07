<template>
  <div id="base_login">
    <el-form :model="loginForm"
             class="login_container"
             label-position="left"
             label-width="0px">
      <h3 class="login_title">Login</h3>
      <el-form-item prop="id">
        <el-input type="text"
                  class="login_input"
                  prefix-icon="el-icon-user-solid"
                  v-model="loginForm.id"
                  auto-complete="off"
                  placeholder="id"></el-input>
      </el-form-item>
      <el-form-item prop="password">
        <el-input type="password"
                  class="login_input"
                  prefix-icon="el-icon-lock"
                  v-model="loginForm.password"
                  auto-complete="off"
                  placeholder="password"></el-input>
      </el-form-item>
      <el-form-item style="width: 100%">
        <el-button type="primary"
                   style="margin:10px auto 0px auto;width: 100%;background: #afb4db;line-height: 0.8"
                   v-on:click="login">login</el-button>
      </el-form-item>
      <br>
      <p style="font-size:50%">copyright @2020~2021 qsy1999 All Rights Reserved.</p>
    </el-form>
          
  </div>

</template>

<script>
  import '@/assets/reset.css'
  export default {
    name: 'Login',
    data () {
      return {
        loginForm: {
          id: '',
          password: '',
        },
      }
    },
    methods: {
      login () {
        if(this.loginForm.id==''||this.loginForm.password==''){
          alert("用户名或密码不能为空");
        }else{
          this.$axios.post('/api/php/login.php',{
             user_ID:this.loginForm.id,
             password:this.loginForm.password,
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             if (response.data.login=="0") {
               alert('登陆失败');
             }else if (response.data.login=="1") {
               alert('登录成功');
               this.$router.push({ name: 'Home', params: { id:loginForm.id ,name:response.data.name }});
             }

             }).catch((error) => {
             console.log(error);
          });
        }
      },

    }
  }
</script>

<style scoped>
  #base_login{
    background: url("../assets/background/checkerboard-cross1.png") repeat;
    background-position: center;
    height: 100%;
    width: 100%;
    background-size: cover;
    position: fixed;
  }
  body{
    margin: 0px;
    padding: 0px;
  }
  .login_container{
    border-radius: 15px;
    background-clip: padding-box;
    margin: 90px auto;
    width: 350px;
    padding: 35px 35px 15px 35px;
    background: #fff;
    border: 1px solid #eaeaea;
    box-shadow: 0 0 25px #cac6c6;
  }
  .login_title {
    margin: 0px auto 30px auto;
    text-align: center;
    color: #494e8f;
  }



</style>
