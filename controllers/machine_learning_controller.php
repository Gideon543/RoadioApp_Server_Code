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

        public function logisticRegressionModel ($value_1, $Z_Mean, $Z_Variance, $Z_Deviation, $Z_Peak, $Z_Low){

            // Calculated for each individual parameter (based on the work of Kwabena - 87% accruacy)
            // Good Vs Bad/Fair
            $theta_1 = 38.388669;
            $theta_2 = -1.658378;
            $theta_3 = 4.517424;
            $theta_4 = -23.416034;
            $theta_5 = 0.305482;
            $theta_6 = -1.711021;

            // Developing a hypothesis function based on both the parameters and weights
            $h1 = ($theta_1 * $value_1) + ($theta_2 * $Z_Mean) + ($theta_3 * $Z_Variance) + ($theta_4 * $Z_Deviation) + ($theta_5 * $Z_Peak) + ($theta_6 * $Z_Low);


            // Passing prediction through a sigmoid function and returning the result
            $prediction = 1 / (1 + exp(-$h1));

            // Evaluatin the prediction from the model
            if($prediction < 0.5){
                return 2; // Bad Roads
            
            } else if($prediction >= 0.5) {
                return 6; // Good Roads
            }
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