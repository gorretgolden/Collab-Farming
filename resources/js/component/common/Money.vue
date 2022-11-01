<template>
	<div>
		<money :class="[booststrapInput, inputClasses]" v-model="price" v-bind="money"></money> 
		<input hidden type="text" class="money-input" :name="name" :value="price" :id="inputId" :required="required">
	</div>
</template>

<script>
	import { Money } from 'v-money'

	export default {
		name:'input-money',
		components: { Money },
		props:{
			inputName:{
				type: String,
				required: true,
			},
			inputPrice:{
				type: Number,
				required: false
			},
			inputId:{
				type: String,
				required: true
			},
			inputClasses:{
				type: Array,
				required: false
			},
			required: {
				type: Boolean,
				required: false,
				default: true
			}
		},
		mounted(){
			let app = this;
			app.name = app.inputName;
			app.price = isNaN(parseFloat(app.inputPrice)) ? 0 : parseFloat(app.inputPrice);
		},
		data () {
			return {
				name: 'amount',
				price: 0.0,
				booststrapInput:'form-control',
				id: '',
				money: {
					decimal: '.',
					thousands: ',',
					prefix: '',
					suffix: '',
					precision: 2,
					masked: false
				}
			}
		},
		methods:{},
		watch: {
			inputPrice: function(newVal, oldVal) {
				this.price = isNaN(parseFloat(newVal)) ? 0 : parseFloat(newVal);
			},
			inputName: function(newVal, oldVal) {
				this.name = newVal;
			},
			price: function(val) {
				var data = {}
				data[this.inputId] = val;
				this.$parent.$emit('price-changed', data);
			}
		}
	}
</script> 