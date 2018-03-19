private function getNarrativebyWord($inputWordFile, $outputHtmlFile)
  {    /* uses cmd_exec to call java jar to convert word to html
       * call cmd_exec command and than return result
       * jar location is currently hardcoded
       * print_r is php function to Prints human-readable information about a variable
       * file_get_contents — Reads entire file into a string
       */
       $uniqout=uniqid("out");
       $tempOutput = "../tools/$uniqout.doc";
      $mime = mime_content_type($inputWordFile);
      if ($mime == "application/msword")
       {$this->cmd_exec('java -jar ../tools/wordtohtml.jar ' . $inputWordFile . '  ' . $outputHtmlFile, $returnvalue, $error);}
      else if ($mime == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
         {$this->cmd_exec('unoconv -f doc -o ' . $tempOutput . '  ' .$inputWordFile, $returnvalue, $error);
             print_r($error);
             print_r($returnvalue);
         }
         {$this->cmd_exec('java -jar ../tools/wordtohtml.jar ' .  $tempOutput. '  ' . $outputHtmlFile, $returnvalue, $error);}

      $output = file_get_contents($outputHtmlFile, true);
      echo $output;
      unlink($tempOutput);
      return $output;
  }
