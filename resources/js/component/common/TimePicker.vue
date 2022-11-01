<template>
<div class="date uhuru-input-group shadow-sm">
    <input :id="id" :name="name" style="background:#fff;" :value="selectedTime" :placeholder="placeHolder" class="form-control" :required="required">
    <div class="uhuru-input-icon">
        <i class="fa fa-calendar"></i>
    </div>
</div>
</template>
<script>
export default {
    name:'time-picker',
    props:{
        name: {
            type: String,
            required: true
        },
        id: {
            type: String,
            required: true
        },
        placeHolder: {
            type: String,
            required: true
        },
        required:{
            type: Boolean,
            required: true
        }
    },
    data(){
        return{
            selectedTime:'',
            required:false
        }
    },
    mounted(){
        $('#'+this.id).flatpickr({
            enableTime:true,
            noCalendar:true,
            dateFormat:'H:i',
            time_24hr:true,
        });
    },
    watch:{
        selectedTime: function(value){

        }
    }
}
</script>
<style scoped>

</style>