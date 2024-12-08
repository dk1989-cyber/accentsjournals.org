<?php

// Sample array
$articles = [
    "Power system reliability and maintenance evolution: a critical review and future perspectives",
    "Harmonic injection based distance protection for line with converter-interfaced sources",
    "An optimal control approach for enhancing transients stability and resilience in super smart grids",
    "Coordinated reactive power strategy using static synchronous compensator for photovoltaic inverters",
    "Harmonics and reactive power compensation of three phase induction motor drive by photovoltaic-based DSTATCOM",
    "Harmonics and reactive power compensation of three phase induction motor drive by photovoltaic-based DSTATCOM",
    "Converter-based dynamics and control of modern power systems",
    "Microgrids: a review of technologies, key drivers, and outstanding issues",
    "Converter-based dynamics and control of modern power systems",
    "State of the art in research on microgrids: a review",
    "Power system reliability and maintenance evolution: a critical review and future perspectives",
    "A critical and comprehensive review on power quality disturbance detection and classification",
    "prnewswire",
    "Power system reliability and maintenance evolution: a critical review and future perspectives",
    "Dynamic energy management of hybrid energy storage systems with a hierarchical structure",
    "Voltage sag, swell and interruption compensation using DVR based on energy storage device",
    "Dynamic voltage restorer (DVR): a comprehensive review of topologies, power converters, control methods, and modified configurations",
    "A comprehensive review of dynamic voltage restorers",
    "Power quality: infrastructures and control",
    "Dynamic performance evaluation of grid-connected hybrid renewable energy-based power generation for stability and power quality enhancement in smart grid",
    "Stability and dynamic analysis of a grid-connected environmentally friendly photovoltaic energy system",
    "Optimal shunt-resonance fault current limiter for transient stability enhancement of a grid-connected hybrid PV/wind power system",
    "Analysis of grid connected hybrid renewable energy system",
    "Global low-carbon energy transition in the post-COVID-19 era",
    "Solar energy market developments in India",
    "Global benchmarking and modelling of installed solar photovoltaic capacity by country",
    "Wind energy research: state-of-the-art and future research directions",
    "Wind energy is not sustainable when balanced by fossil energy",
    "Reliability, economic and environmental analysis of a microgrid system in the presence of renewable energy resources",
    "Optimization of distributed generation based hybrid renewable energy system for a DC micro-grid using particle swarm optimization",
    "Proton exchange membrane hydrogen fuel cell as the grid connected power generator",
    "Optimal energy management and scheduling of a microgrid considering hydrogen storage and PEMFC with uncertainties",
    "Design and implementation of three-phase smart inverter of the photovoltaic power generation systems",
    "Optimization in microgrids with hybrid energy systems–a review",
    "Hybrid renewable microgrid optimization techniques: a review",
    "Optimal synergy between photovoltaic panels and hydrogen fuel cells for green power supply of a green building—a case study",
    "Grid integrated renewable DG systems: A review of power quality challenges and state‐of‐the‐art mitigation techniques",
    "Power quality improvement using dynamic voltage restorer",
    "A comparative study of PI, fuzzy‐PI, and sliding mode control strategy for battery bank SOC control in a standalone hybrid renewable system",
    "Harmonics reduction using multilevel based shunt active filter with SMES",
    "Modeling and control of photovoltaic and fuel cell based alternative power systems",
    "Global low-carbon energy transition in the post-COVID-19 era",
    "Hybrid renewable microgrid optimization techniques: a review",
    "Wind energy research: state-of-the-art and future research directions",
    "Wind energy research: state-of-the-art and future research directions",
    "Wind energy research: state-of-the-art and future research directions",
    "Global benchmarking and modelling of installed solar photovoltaic capacity by country",
    "Optimization of distributed generation based hybrid renewable energy system for a DC micro-grid using particle swarm optimization",
    "Global benchmarking and modelling of installed solar photovoltaic capacity by country",
    "Optimization of distributed generation based hybrid renewable energy system for a DC micro-grid using particle swarm optimization"
];

// Array to store the first occurrence of strings
$unique = [];

// Arrays to categorize original and duplicate strings
$originals = [];
$duplicates = [];

foreach ($articles as $article) {

    if (!isset($unique[$article])) {
        // First occurrence: mark as original
        $unique[$article] = true;
        $originals[] = $article;
    } else {
        // Subsequent occurrence: mark as duplicate
        $duplicates[] = $article;
    }

}

// Display results
echo "Original Strings:\n";
foreach ($originals as $original) {
    echo "- $original\n";
}

echo "\nDuplicate Strings:\n";
foreach ($duplicates as $duplicate) {
    echo "- $duplicate\n";
}
