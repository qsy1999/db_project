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
             label-width="0px"
             v-if="mode!='0'">
      <el-form-item prop="name">
        <el-input type="text"
                  prefix-icon="el-icon-user-solid"
                  v-model="newInfoForm.name"
                  auto-complete="off"
                  placeholder="新护士的名字"></el-input>
      </el-form-item>
      <el-form-item prop="password">
        <el-input type="password"
                  prefix-icon="el-icon-lock"
                  v-model="newInfoForm.password"
                  auto-complete="off"
                  placeholder="新护士的密码"></el-input>
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
                   v-on:click="addNurse"
                   >提交</el-button>
      </el-form-item>
    </el-form>

    <el-form :model="patientInfoForm"
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
             label-width="0px"
             v-if="mode=='1'">
      <el-form-item prop="name">
        <el-input type="text"
                  prefix-icon="el-icon-user-solid"
                  v-model="patientInfoForm.name"
                  auto-complete="off"
                  placeholder="病人名字"></el-input>
      </el-form-item>
      <el-form-item >
        <el-input type="text"
                  prefix-icon="el-icon-lock"
                  v-model="patientInfoForm.NACheck_result"
                  auto-complete="off"
                  placeholder="核酸检测结果"></el-input>
      </el-form-item>
      <el-form-item >
        <el-date-picker
            v-model="patientInfoForm.NACheck_time"
            type="datetime"
            placeholder="核酸检测时间">
        </el-date-picker>
      </el-form-item>

      <el-form-item >
        <el-input type="text"
                  prefix-icon="el-icon-lock"
                  v-model="patientInfoForm.level"
                  auto-complete="off"
                  placeholder="病情评级"></el-input>
      </el-form-item>
      
      <el-form-item style="width: 100%">
        <el-button type="primary"
                   style="margin:10px auto 0px auto;width: 100%;background: #afb4db;line-height: 0.8"
                   v-on:click="addPatient"
                   >提交</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
  export default {
    name: 'Add',
    data () {
      return {
        mode:'1',
        newInfoForm: {
          name: '',
          password: '',
        },
        password_2:'',
        patientInfoForm:{
            name: '',
            NACheck_result: '',
            NACheck_time: '',
            level:'',
        }
      }
    },
    props:{
      id:String,
      type:String,
      area:String,
    },

    methods: {
      addNurse () {
        if(this.newInfoForm.password==''||this.newInfoForm.name==''||this.newInfoForm.password!=this.password_2){
          alert("提交失败，两次密码不一致，或是无效的密码或姓名");
        }else{
          console.log(this.newInfoForm.name);
          console.log(this.area);
          console.log(this.newInfoForm.password);

          this.$axios.post('/api/addHospitalNurse.php',{
              name:this.newInfoForm.name,
              area:this.area,
              password:this.newInfoForm.password,
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             if (response.data.success=="0") {
               alert('创建失败');
             }else if (response.data.success=="1") {
               alert('创建成功');
             }

             }).catch((error) => {
             console.log(error);
          });
        }
      },
      addPatient () {
          console.log(this.id);
          this.$axios.post('/api/receivePatient.php',{
          	  id:this.id,
          	  name:this.patientInfoForm.name,
          	  NACheck_result:this.patientInfoForm.NACheck_result,
              NACheck_time:this.patientInfoForm.NACheck_time,
          	  level:this.patientInfoForm.level,
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             if (response.data.success=="0") {
               alert('创建失败');
             }else if (response.data.success=="1") {
               alert('创建成功');
             }

             }).catch((error) => {
             console.log(error);
          });
      }
    },
    mounted(){
        this.mode=this.type;
    }
  }
</script>

<style scoped>


</style>
