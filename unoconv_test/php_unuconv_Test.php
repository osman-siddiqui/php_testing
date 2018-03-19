<?php

 function cmd_exec($cmd, &$stdout, &$stderr)
    {
        $outfile        = tempnam(".", "cmd");
        $errfile        = tempnam(".", "cmd");
        $descriptorspec = array(
            0 => array(
                "pipe",
                "r"
            ),
            1 => array(
                "file",
                $outfile,
                "w"
            ),
            2 => array(
                "file",
                $errfile,
                "w"
            )
        );
        $proc           = proc_open($cmd, $descriptorspec, $pipes);

        if (!is_resource($proc))
            return 255;

        fclose($pipes[0]); //Don't really want to give any input

        $exit   = proc_close($proc);
        $stdout = file($outfile);
        $stderr = file($errfile);

        unlink($outfile);
        unlink($errfile);
        return $exit;
    }
 function getNarrativebyWord($inputWordFile, $outputHtmlFile)
  {    /* uses cmd_exec to call java jar to convert word to html
       * call cmd_exec command and than return result
       * jar location is currently hardcoded
       * print_r is php function to Prints human-readable information about a variable
       * file_get_contents — Reads entire file into a string
       */
       $uniqout=uniqid("out");
       $tempOutput = $uniqout.'doc';
        cmd_exec('unoconv -f doc -o ' . $tempOutput . '  ' .$inputWordFile, $returnvalue, $error);
             print_r($error);
             print_r($returnvalue);

        cmd_exec('java -jar wordtohtml.jar ' .  $tempOutput. '  ' . $outputHtmlFile, $returnvalue, $error);
        print_r($error);
        print_r($returnvalue);

      $output = file_get_contents($outputHtmlFile, true);
      echo $output;
      unlink($tempOutput);
      return $output;
  }
  $docxfile ="HNSC-PTEN.docx";
  $htmlfile ="test.html";
  getNarrativebyWord($docxfile, $htmlfile);

?>
