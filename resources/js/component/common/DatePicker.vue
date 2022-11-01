<template>
<div class="date uhuru-input-group shadow-sm">
    <input :id="id" :name="name" style="background:#fff;" :value="selectedData" :placeholder="placeHolder" class="form-control" :required="isRequired">
    <div class="uhuru-input-icon">
        <i class="fa fa-calendar"></i>
    </div>
</div>
</template>
<script>
export default {
    name:'date-picker',
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
        isRequired:{
            type: Boolean,
            required: true
        }
    },
    data(){
        return{
            selectedData:'',
            required:false
        }
    },
    mounted(){
        $('#'+this.id).flatpickr({
            dateFormat: 'j/M/y',
            allowInput: true
        });
    },
    watch:{
        selectedData: function(value){

        }
    }
}
</script>
<style scoped>

</style>
