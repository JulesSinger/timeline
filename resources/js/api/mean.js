import { ref } from 'vue'

export default function useMean() {
  const course_units = ref()
  const getCourseUnits = async () => {
    let response = await axios.get('/api/mean/course_units')
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