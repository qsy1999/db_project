<template>
  <div>
    <el-form :model="newInfoForm"
             style="
               border-radius: 15px;
               background-clip: padding-box;
               margin: 90px auto;
               width: 350px;
               padding: 35px 35px 15px 35px;
               background: #fff;
               border: 1px solid #eaeaea;
               box-shadow: 0 0 25px #cac6c6;"
             label-position="left"
             label-width="0px">
      <el-form-item prop="name">
        <el-input type="text"
                  prefix-icon="el-icon-user-solid"
                  v-model="newInfoForm.name"
                  auto-complete="off"
                  placeholder="name"></el-input>
      </el-form-item>
      <el-form-item prop="password">
        <el-input type="password"
                  prefix-icon="el-icon-lock"
                  v-model="newInfoForm.password"
                  auto-complete="off"
                  placeholder="password"></el-input>
      </el-form-item>
      <el-form-item prop="password">
        <el-input type="password"
                  prefix-icon="el-icon-lock"
                  v-model="password_2"
                  auto-complete="off"
                  placeholder="type password again"></el-input>
      </el-form-item>
      
      <el-form-item style="width: 100%">
        <el-button type="primary"
                   style="margin:10px auto 0px auto;width: 100%;background: #afb4db;line-height: 0.8"
                   >提交</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
  export default {
    name: 'Register',
    data () {
      return {
        newInfoForm: {
          name: '',
          password: '',
        },
        password_2:'',
      }
    },


    methods: {
      
    }
  }
</script>

<style scoped>


</style>
