import { ref } from 'vue'

export default function useTodolist(todolist_id) {
  const todolist = ref()
  const todos = ref()
  

  const getTodolist = async () => {
    let response = await axios.get(`/api/todolist/${todolist_id}`)
    todolist.value = response.data.data
  }

  const getTodos = async () => {
    let response = await axios.get(`/api/todolist/${todolist_id}/todos`)
    todos.value = response.data.data
  }

  return {
    todolist,
    todos,
    getTodolist,
    getTodos,
  }
}

export {
  useTodolist
}