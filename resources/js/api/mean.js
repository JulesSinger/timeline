import { ref } from 'vue'
import axiosClient from '../axios'

export default function useMean() {
  const course_units = ref()
  const getCourseUnits = async () => {
    let response = await axiosClient.get('/api/mean/course_units')
    course_units.value = response.data.data
  }

  return {
    course_units,
    getCourseUnits
  }
}

export {
  useMean
}