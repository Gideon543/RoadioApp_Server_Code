<?php
namespace controllers;
    // require __DIR__."/../models/data_from_phones_model.php";

    class MachineLearningModels{
        
        /**
        * Logistic regression model that predicts road surface quality using the parameters below:
        * Hypothesis function used here: 
        * @param $Z_Mean, $Z_Variance, $Z_Deviation, $Z_Peak, $Z_Low (produced from mobile devices)
        * @return Returns a classification.
        **/
        public function logisticRegressionModel ($Z_Mean, $Z_Variance, $Z_Deviation, $Z_Peak, $Z_Low){

            // Calculated for each individual parameter (based on the work of Kwabena - 87% accruacy)
            $theta_1 = 38.388669;
            $theta_2 = -1.658378;
            $theta_3 = 4.517424;
            $theta_4 = -23.416034;
            $theta_5 = -1.711021;


            // Developing a hypothesis function based on both the parameters and weights
            $h = ($theta_1 * $Z_Mean) + ($theta_2 * $Z_Variance) + ($theta_3 * $Z_Deviation) + ($theta_2 * $Z_Peak) + ($theta_2 * $Z_Low);

            // Passing prediction through a sigmoid function and returning the result
            return 1 / (1 + exp(-$h));
        }

        
        /**
        * Decision tree model
        * @param $params - captures the values of the input vector
        **/
        public function decisionTreeModel ($params){

        }

        /**
        * Neural Network based model
        * @param $params - captures the values of the input vector
        **/
        public function NNModel ($params){
          
        }

    }
?>