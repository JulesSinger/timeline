import { ref } from 'vue'
import axiosClient from '../axios'

export default function useTodolist(todolist_id) {
  const todolist = ref()
  const todolists = ref()
  const getTodolist = async () => {
    let response = await axiosClient.get(`/api/todolist/${todolist_id}`)
    todolist.value = response.data.data
  }

  const getTodolists = async () => {
    let response = await axiosClient.get(`/api/todolists`)
    todolists.value = response.data.data
  }

  const deleteTodo = async (todo_id) => {
    let response = await axiosClient.delete(`/api/todolist/${todolist_id}/todos/${todo_id}`)
    todolist.value = response.data.todolist
  }

  const deleteTodolist = async (id) => {
    let response = await axiosClient.delete(`/api/todolist/${id}`)
    todolists.value = response.data.todolists
  }

  const postTodolist = async (form) => {
    let response = await axiosClient.post(`/api/todolist/insert`, form)
    todolists.value = response.data.todolists
  }

  const updateTodolist = async (form, id) => {
    let response = await axiosClient.patch(`/api/todolist/${id}/update`, form)
    todolists.value = response.data.todolists
  }

  const updateTodo = async (form) => {
    let response = await axiosClient.patch(`/api/todolists/${todolist_id}/todos/${todo_id}/update`, form)
    todolists.value = response.data.todolists
  }

  const postTodo = async (form) => {
    let response = await axiosClient.post(`/api/todolists/${todolist_id}/todos/insert`, form)
    todolist.value = response.data.todolist
  }

  const switchTodo = async (todo_id) => {
    let response = await axiosClient.post(`/api/todolists/${todolist_id}/todos/${todo_id}/switch`)
    todolist.value = response.data.todolist
  }

  return {
    todolist,
    todolists,
    getTodolist,
    getTodolists,
    deleteTodo,
    deleteTodolist,
    postTodolist,
    postTodo,
    switchTodo,
    updateTodo,
    updateTodolist
  }
}

export {
  useTodolist
}