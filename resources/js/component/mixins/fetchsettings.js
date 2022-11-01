import axios from 'axios'
import { ref } from 'vue'

export function useCenters(){
    const centers = ref([])

    const getCenters = async () => {
        let response = await axios.get('api/centers')
        centers.value = response.data.center;
    }

    return {
        centers,
        getCenters
    }
}