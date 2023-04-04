<template>
  <div id="todolist-page" v-if="todolist">
    <h1 class="text-center">Ma todolist</h1>
    <h2 class="text-center">{{ todolist.name }}</h2>
    <div id="todos-container">
      <div v-for="todo in todolist.todos" :key="todo.id" class="todo">
        <input type="checkbox" @click="callSwitchTodo(todo.id)" :checked="todo.done" >
        <div class="todo-title">
          <h3>{{ todo.title }}</h3>
        </div>
        <div class="todo-content">
          <p>{{ todo.description }}</p>
        </div>
        <div class="todo-actions">
          <img src="/images/delete.svg" @click="callDeleteTodo(todo.id)" alt="delete"/>
        </div>
      </div>

      <div id="create-todo">
        <div class="input-container">
          <label for="name">Nom de la tâche</label>
          <input type="text" v-model="insert_form.title" placeholder="Nom de la tâche">
        </div>

        <div class="input-container">
          <label for="description">Description de la tâche</label>
          <input type="text" v-model="insert_form.description" placeholder="Description de la tâche">
        </div>

        <div class="input-container">
          <label for="priority">Priorité de la tâche</label>
          <input type="number" v-model="insert_form.priority" placeholder="Priorité de la tâche">
        </div>

        <div class="input-container">
          <label for="deadline">Date limite de la tâche</label>
          <input type="date" v-model="insert_form.deadline" placeholder="Date limite de la tâche">
        </div>

        <button class="btn btn-markup" @click="callPostTodo()">Ajouter</button>
      </div>

    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { useTodolist } from '../api/todolist.js'
import { useRoute } from 'vue-router';

const route = useRoute()
const todolist_id = route.params.id
const insert_form = reactive({
  title: '',
  description: '',
  priority: 0,
  deadline: '',
})
const { todolist, getTodolist, deleteTodo, postTodo, switchTodo } = useTodolist(todolist_id)

const callDeleteTodo = (id) => {
  deleteTodo(id)
}

const callPostTodo = () => {
  postTodo(insert_form)
}

const callSwitchTodo = (id) => {
  switchTodo(id)
}
getTodolist()

</script>