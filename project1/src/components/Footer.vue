<template>

  <div style="background-color:#545c64;margin-top:50px;padding:50px 50px 20px 50px">
    <el-row class="footer_item" style="margin-top:30px">
      copyright @2020~2021 qsy1999 All Rights Reserved.
    </el-row>
  </div>

</template>

<script>
import '@/assets/reset.css'
export default {
  name: 'Footer',
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
 .footer_item{
   color:white;
   text-align:center;
   font-size:80%;
 }
</style>
