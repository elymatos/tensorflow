set BERT_BASE_DIR=E:\ely\devel\tensorflow\bert_model\uncased_L-12_H-768_A-12
set GLUE_DIR=E:\ely\devel\tensorflow\bert_local\glue_data
set TRAINED_CLASSIFIER=/path/to/fine/tuned/classifier

python ..\bert\run_classifier_with_tfhub.py ^
  --task_name=MRPC ^
  --do_train=true ^
  --do_eval=true ^
  --data_dir=%GLUE_DIR%/MRPC ^
  --vocab_file=%BERT_BASE_DIR%/vocab.txt ^
  --bert_config_file=%BERT_BASE_DIR%/bert_config.json ^
  --init_checkpoint=%BERT_BASE_DIR%/bert_model.ckpt ^
  --max_seq_length=128 ^
  --train_batch_size=32 ^
  --learning_rate=2e-5 ^
  --num_train_epochs=3.0 ^
  --output_dir=./temp/mrpc_output/

  export BERT_BASE_DIR=/path/to/bert/uncased_L-12_H-768_A-12
  export GLUE_DIR=/path/to/glue
  export TRAINED_CLASSIFIER=/path/to/fine/tuned/classifier

  python run_classifier.py \
    --task_name=MRPC \
    --do_predict=true \
    --data_dir=$GLUE_DIR/MRPC \
    --vocab_file=$BERT_BASE_DIR/vocab.txt \
    --bert_config_file=$BERT_BASE_DIR/bert_config.json \
    --init_checkpoint=$TRAINED_CLASSIFIER \
    --max_seq_length=128 \
    --output_dir=/tmp/mrpc_output/