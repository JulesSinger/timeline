<template>
  <div id="meancalculator-page">
    <h1 class="text-center">Calculateur de moyenne</h1>
    <div v-for:="unit in course_units" id="units-container">
      <div class="unit-container" >
        <div class="unit-header text-center">
          <p> {{ unit.name }} </p>
          <p> Coefficient {{ unit.coefficent }} </p>
        </div>

        <div class="unit-content text-center" v-for="sub in unit.subjects">
          <div class="subject-header">
            <p>{{ sub.name }}</p>
            <p>Coefficient {{ sub.coefficent }}</p>
          </div>
          <div class="subject-content" v-for="mark in sub.marks">
            {{ mark.mark }}*{{ mark.coefficent }}
          </div>
        </div>

        <div class="unit-header text-center">
          <p> {{ unit.name }} </p>
          <p> Coefficient {{ unit.coefficent }} </p>
        </div>
      </div>    
      <div class="unit-means text-center">
        <p>Moyennes</p>
        <p v-for="sub in unit.subjects"> {{ calculateSubjectMean(sub) }} </p>
        <p id="unit-mean">{{ calculateUnitMean(unit) }}</p>
      </div>
    </div>

    <div v-if="!createUnit" id="add-new-unit" class="btn btn-markup" @click="createUnit = true">
      AJOUTER UNE UE
    </div>

    <div v-if="createUnit" id="form-unit">
      <div class="unit-container">
        <div class="unit-header">
          <h1>Ajouter une UE</h1>
          <input type="text" placeholder="nom de l'UE">
          <input type="number" placeholder="coefficient de l'UE">
        </div>
      </div>  
    </div>

    <div v-if="course_units" id="global-mean">
      <p>Moyenne générale</p>
      <p>{{ calculateGlobalMean() }}</p>
    </div>
  </div>
</template>

<script setup>

import { onMounted, ref } from 'vue'
import { useMean } from '../api/mean.js'

const { course_units, getCourseUnits } = useMean()

onMounted(() => {
  getCourseUnits()
})

const calculateSubjectMean = (subject) => {
  let sum = 0
  let coefficentSum = 0
  subject.marks.forEach(mark => {
    sum += mark.mark * mark.coefficent
    coefficentSum += mark.coefficent
  })
  if (isNaN(sum / coefficentSum)) return null
  return (sum / coefficentSum).toFixed(2)
}

const calculateUnitMean = (unit) => {
  let sum = 0
  let coefficentSum = 0
  unit.subjects.forEach(subject => {
    sum += calculateSubjectMean(subject) * subject.coefficent
    coefficentSum += subject.coefficent
  })
  if (isNaN(sum / coefficentSum)) return null
  return (sum / coefficentSum).toFixed(2)
}

const calculateGlobalMean = () => {
  let sum = 0
  let coefficentSum = 0
  course_units.value.forEach(unit => {
    if(unit.subjects.length != 0) {
      sum += calculateUnitMean(unit) * unit.coefficent
      coefficentSum += unit.coefficent
    }
  })
  if (isNaN(sum / coefficentSum)) return null
  return (sum / coefficentSum).toFixed(2)
}
let createUnit = ref(false)

</script>