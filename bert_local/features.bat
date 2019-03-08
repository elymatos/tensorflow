set BERT_BASE_DIR=E:\ely\devel\tensorflow\bert_model\multi_cased_L-12_H-768_A-12

python ..\bert\extract_features.py ^
  --input_file=input02.txt ^
  --output_file=output02.json ^
  --vocab_file=%BERT_BASE_DIR%/vocab.txt  ^
  --bert_config_file=%BERT_BASE_DIR%/bert_config.json ^
  --init_checkpoint=%BERT_BASE_DIR%/bert_model.ckpt ^
  --layers=-1,-2,-3,-4 ^
  --max_seq_length=128 ^
  --batch_size=8
