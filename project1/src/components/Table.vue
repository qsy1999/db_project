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
        <el-button type="text" size="small" v-if="type!=1" @click="dialogVisible = true;displayPatient(scope.row)">查看</el-button>
        <el-button type="text" size="small" v-if="type==1&&auth==1" @click="dismiss(scope.row);">开除</el-button>
       </template>
      </el-table-column>
    </el-table>

    <el-dialog
      title="具体信息"
      :visible.sync="dialogVisible"
      width="85%">

      <span style="margin-left:5%">id:&nbsp{{detail.id}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspname:&nbsp{{detail.name}}</span>
      <br>
      <div style="margin:20px 0 0 50px">
      <el-button type="success" size="small" @click="changeShow()">切换&nbsp状态/核酸检测单</el-button>
      <el-button type="primary" size="small" v-if="auth==0" @click="show=2">添加新核酸检测记录</el-button>
      <el-button type="primary" size="small" v-if="auth==3" @click="show=3">&nbsp&nbsp&nbsp&nbsp信息登记&nbsp&nbsp&nbsp&nbsp</el-button>
      <el-button type="primary" size="small" v-if="auth==0">确认病人死亡</el-button>
      <el-button type="primary" size="small" v-if="auth==0">允许病人出院</el-button>
      </div>
      <br>
      <el-table
      :data="detail.history"
      style="width: 90%; margin:10px 5%"
      v-if="show == 0">
      <el-table-column
        prop="time"
        label="记录时间">
      </el-table-column>
      <el-table-column
        prop="recorder"
        label="记录者">
      </el-table-column>
      <el-table-column
        prop="temperature"
        label="体温">
      </el-table-column>
      <el-table-column
        prop="symptom"
        label="症状">
      </el-table-column>
      <el-table-column
        prop="life_status"
        label="状态">
      </el-table-column>      
      <el-table-column
        prop="result"
        label="核酸检测结果">
      </el-table-column>
      <el-table-column
        prop="level"
        label="病情评级">
      </el-table-column>
      <el-table-column
        prop="NA_recorder"
        label="核酸检测者">
      </el-table-column>
      <el-table-column
        prop="NA_time"
        label="核酸检测时间">
      </el-table-column>
    </el-table>

    <el-table
      :data="detail.result"
      style="width: 90%; margin:10px 5%"
      v-if="show == 1">
      <el-table-column
        prop="result"
        label="核酸检测结果">
      </el-table-column>
      <el-table-column
        prop="level"
        label="病情评级">
      </el-table-column>
      <el-table-column
        prop="NA_recorder"
        label="核酸检测者">
      </el-table-column>
      <el-table-column
        prop="NA_time"
        label="核酸检测时间">
      </el-table-column>
    </el-table>

      <el-form :model="patientInfoForm"
             label-position="left"
             label-width="0px"
             style="width:50%;margin-left:25%;margin-top:40px"
             v-if="show==2">
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
                   v-on:click="chcekNA"
                   >提交</el-button>
      </el-form-item>
    </el-form>

      <el-form :model="patientInfoFormMKII"
             label-position="left"
             label-width="0px"
             style="width:50%;margin-left:25%;margin-top:40px"
             v-if="show==3">
      <el-form-item >
        <el-input type="text"
                  prefix-icon="el-icon-lock"
                  v-model="patientInfoFormMKII.temperature"
                  auto-complete="off"
                  placeholder="体温"></el-input>
      </el-form-item>
      <el-form-item >
        <el-date-picker
            v-model="patientInfoFormMKII.time"
            type="datetime"
            placeholder="登记时间">
        </el-date-picker>
      </el-form-item>

      <el-form-item >
        <el-input type="text"
                  prefix-icon="el-icon-lock"
                  v-model="patientInfoFormMKII.symptom"
                  auto-complete="off"
                  placeholder="症状"></el-input>
      </el-form-item>
      
      <el-form-item >
        <el-input type="text"
                  prefix-icon="el-icon-lock"
                  v-model="patientInfoFormMKII.life_status"
                  auto-complete="off"
                  placeholder="生命状态"></el-input>
      </el-form-item>

      <el-form-item style="width: 100%">
        <el-button type="primary"
                   style="margin:10px auto 0px auto;width: 100%;background: #afb4db;line-height: 0.8"
                   v-on:click="recordPatient"
                   >提交</el-button>
      </el-form-item>
    </el-form>

    </el-dialog>
  </div>

</template>

<script>
import '@/assets/reset.css'
export default {
  name: 'Table',
  data () {
    return {
      show:0,
      detail:{
        id:'',
        name:'',
        history:[],
        result:[],
      },
      dialogVisible:false,
      patientInfoForm:{
            NACheck_result: '',
            NACheck_time: '',
            level:'',
        },
      patientInfoFormMKII:{
            temperature: '',
            symptom: '',
            life_status:'',
            time:'',
        },
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
        var id = row.id;

        if (this.type == 2) {
           this.$axios.post('/api/getPatientFromBed.php',{
              bed_ID:id
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             id=response.data.id;
              this.detail.id = id;
              this.detail.name = row.name;
              this.$axios.post('/api/getPatientStatusHistory.php',{
	               id:id,
                }).then((response) => {
                   console.log(response);
                   console.log(response.data);
                   this.detail.history = response.data[0];
                   this.detail.result = response.data[1];

                   }).catch((error) => {
                   console.log(error);
               });
             }).catch((error) => {
             console.log(error);
          });
        }else{
        this.detail.id = id;
        this.detail.name = row.name;
        this.$axios.post('/api/getPatientStatusHistory.php',{
	          id:row.id,
           }).then((response) => {
             console.log(response);
             console.log(response.data);
             this.detail.history = response.data[0];
             this.detail.result = response.data[1];

             }).catch((error) => {
             console.log(error);
          });
        }
      },
      dismiss(row)
      {
        this.$axios.post('/api/dismiss.php',{
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
      chcekNA()
      {
          console.log(this.id);
          this.$axios.post('/api/checkNA.php',{
	          id:this.id,
            targetID:this.detail.id,
            result:this.patientInfoForm.NACheck_result,
          	time:this.patientInfoForm.NACheck_time,
	          level:this.patientInfoForm.level,
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

      recordPatient()
      {
          this.$axios.post('/api/recordPatient.php',{
            	id:this.id,
	            targetID:this.detail.id,
	            temperature:this.patientInfoFormMKII.temperature,
              symptom:this.patientInfoFormMKII.symptom,
              life_status:this.patientInfoFormMKII.life_status,
              time:this.patientInfoFormMKII.time,
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

      changeShow()
      {
        if(this.show==0)this.show=1;
        else this.show=0;
      }
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>