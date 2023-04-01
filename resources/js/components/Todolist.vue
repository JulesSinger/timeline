<template>
  <div id="todolist-page" v-if="todolist">
    <h1 class="text-center">Ma todolist</h1>
    <h2 class="text-center">{{ todolist.name }}</h2>
    <div id="todos-container">
      <div v-for="todo in todolist.todos" :key="todo.id" class="todo">
        <div class="todo-title">
          <h3>{{ todo.name }}</h3>
        </div>
        <div class="todo-content">
          <p>{{ todo.description }}</p>
        </div>
        <div class="todo-actions">
          <img src="/images/delete.svg" @click="callDeleteTodo(todo.id)" alt="delete"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useTodolist } from '../api/todolist.js'
import { useRoute } from 'vue-router'

const route = useRoute()
let todolist_id = route.params.id
if(!todolist_id) {
  todolist_id = 1
}

const { todolist, getTodolist, deleteTodo } = useTodolist(todolist_id)

const callDeleteTodo = (id) => {
  deleteTodo(id)
}
getTodolist()

</script>