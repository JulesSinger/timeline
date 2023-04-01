import { ref } from 'vue'
import axiosClient from '../axios'

export default function useTimeline(insert_form = null, update_form = null) {
  const timeline_items = ref()
  const getTimelineItems = async () => {
    let response = await axiosClient.get(`/api/timeline/items`, 
    {
      headers: {
        "Access-Control-Allow-Origin": "*",
      }
    })
    timeline_items.value = response.data.data
    
    let sum = 0
    timeline_items.value.forEach((item) => {
      const date = item.date.split(" ")[0].split('/')
      const comp = new Date(date[2], date[1] - 1, date[0]);
        if (comp < new Date()) {
          item.dot = 'red';
          sum++;
        } else {
          item.dot = 'black';
        }
    })
    if (sum < timeline_items.value.length) {
      timeline_items.value[sum].dot = 'yellow';
      timeline_items.value[sum].class = 'animate';
      const date = timeline_items.value[sum].date.split(" ")[0].split('/')
      let sameDate = true
      while (sum < timeline_items.value.length && sameDate) {
        const dateNextElement = timeline_items.value[sum+1].date.split(" ")[0].split('/')
    
        if(dateNextElement[0] == date[0] && dateNextElement[1] == date[1] && dateNextElement[2] == date[2]) {
          timeline_items.value[sum+1].dot = 'yellow';
          timeline_items.value[sum+1].class = 'animate';
          sum++;
        } else {
          sameDate = false
        }
      }
    }
  }

  const postTimelineItem = async (onSuccess = null) => {
    await axiosClient.post(`/api/timeline/insert`, insert_form)
    .then((response) => {
        if (onSuccess !== null) return onSuccess(response)
    })
    .catch((error) => {
        console.log(error)
    })
  }

  const updateTimelineItem = async (itemId, onSuccess = null) => {
    await axiosClient.patch(`/api/timeline/update/${itemId}`, update_form)
    .then(response => {
      if(onSuccess !== null) return onSuccess(response)
        
    })
    .catch(error => {
        console.log(error)
    })
  }

  const deleteTimelineItem = async (itemId,onSuccess = null) => {
    await axiosClient.delete(`/api/timeline/delete/${itemId}`)
    .then(response => {
        if(onSuccess !== null) return onSuccess(response)
    })
    .catch(error => {
        console.log(error)
    })
  }
  
  return {
    timeline_items,
    getTimelineItems,
    postTimelineItem,
    updateTimelineItem,
    deleteTimelineItem
  }
}

export {
  useTimeline
}