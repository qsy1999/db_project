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
             v-if="mode=='chief nurse'">
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
             v-if="mode=='emergency nurse'">
      <el-form-item prop="name">
        <el-input type="text"
                  prefix-icon="el-icon-user-solid"
                  v-model="patientInfoForm.name"
                  auto-complete="off"
                  placeholder="病人名字"></el-input>
      </el-form-item>
      <el-form-item >
        <el-date-picker
            v-model="patientInfoForm.time"
            type="datetime"
            placeholder="登记时间">
        </el-date-picker>
      </el-form-item>
            <el-form-item >
        <el-input type="text"
                  prefix-icon="el-icon-lock"
                  v-model="patientInfoForm.temperature"
                  auto-complete="off"
                  placeholder="体温"></el-input>
      </el-form-item>
            <el-form-item >
        <el-input type="text"
                  prefix-icon="el-icon-lock"
                  v-model="patientInfoForm.symptom"
                  auto-complete="off"
                  placeholder="症状"></el-input>
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
            temperature:'',
            symptom:'',
            time:'',
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
               this.autoFillFromIA();               
               this.autoFill(this.detail.area);
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
              temperature:this.patientInfoForm.temperature,
              symptom:this.patientInfoForm.symptom,
              time:this.patientInfoForm.time,
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
      },
      autoFill(to)
      {
          console.log(to);
         this.$axios.post('/api/autoFill.php',{
            to:to,
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             if (response.data.stop==1) {
               return
             }else if (response.data.stop==0){
               this.autoFill(response.data.newTo);
             }
             }).catch((error) => {
             console.log(error);
          });
      },

      autoFillFromIA()
      {
        this.$axios.post('/api/autoFillFromIA.php',{
           }).then((response) => {
             console.log(response);
             console.log(response.data);

             }).catch((error) => {
             console.log(error);
          });
      },
    },
    mounted(){
        this.mode=this.type;
    }
  }
</script>

<style scoped>


</style>
