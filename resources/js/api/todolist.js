import { ref } from 'vue'

export default function useTodolist(todolist_id) {
  const todolist = ref()
  const todolists = ref()
  const getTodolist = async () => {
    let response = await axios.get(`/api/todolist/${todolist_id}`)
    todolist.value = response.data.data
  }

  const getTodolists = async () => {
    let response = await axios.get(`/api/todolists`)
    todolists.value = response.data.data
  }

  const deleteTodo = async (todo_id) => {
    let response = await axios.delete(`/api/todolist/${todolist_id}/todos/${todo_id}`)
    todolist.value = response.data.todolist
  }

  const deleteTodolist = async (id) => {
    let response = await axios.delete(`/api/todolist/${id}`)
    todolists.value = response.data.todolists
  }

  return {
    todolist,
    todolists,
    getTodolist,
    getTodolists,
    deleteTodo,
    deleteTodolist
  }
}

export {
  useTodolist
}