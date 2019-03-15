set BERT_BASE_DIR=E:\ely\devel\tensorflow\bert_model\uncased_L-12_H-768_A-12
set DOMINO_DIR=E:\ely\devel\tensorflow\bert_local\domino_data

python ..\bert\run_classifier_domino.py ^
  --task_name=cola ^
  --do_train=true ^
  --do_eval=true ^
  --data_dir=%DOMINO_DIR%/Cola ^
  --vocab_file=%BERT_BASE_DIR%/vocab.txt ^
  --bert_config_file=%BERT_BASE_DIR%/bert_config.json ^
  --init_checkpoint=%BERT_BASE_DIR%/bert_model.ckpt ^
  --max_seq_length=128 ^
  --train_batch_size=32 ^
  --learning_rate=2e-5 ^
  --num_train_epochs=3.0 ^
  --output_dir=./temp/domino_output/