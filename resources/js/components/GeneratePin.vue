<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">PIN Genrator</div>

                    <div class="card-body">
                        <button @click="generatePIN()" class="button">Generate PIN</button>
                       <span class="pin-span" v-if="pinGenerated">Your PIN is : <strong>{{pinCode}}</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pinGenerated: false,
                pinCode: '',
            }
        },
        methods: {
            generatePIN(){
                axios.post('generate-pin')
                .then((response)=>{
                    this.pinGenerated = true
                    this.pinCode = response.data.payload;
                })
                .catch((error)=>{
                    this.$swal('OOOOOOOOOPS!','Error has been occurred, please try again later','error');
                    this.pinGenerated = false
                    this.pinCode = '';
                });
            }
        },
    }
</script>
<style scoped>
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.pin-span{
    display: block;
    margin-top: 10px;
}
</style>
